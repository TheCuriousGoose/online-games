import { executeGetFetch, executePostFetch, updateCreditsDisplay } from "./app";

let credits = 0;
let gameActive = false;
let activeGameName = '';

document.addEventListener('DOMContentLoaded', async () => {
    const gameCards = document.querySelectorAll('.game-card');
    const bigGameCard = document.getElementById('big-game-card');
    const isLoggedIn = document.querySelector('meta[name="logged-in"]').getAttribute('content');
    const getGamesURL = document.querySelector('meta[name="get-game"]').getAttribute('content');

    let queryClass = isLoggedIn === 'true' ? '.logged-in' : '.not-logged-in';

    if (isLoggedIn === 'true') {
        const getCreditUrl = document.querySelector('meta[name="get-user-credits"]').getAttribute('content');

        credits = await executeGetFetch(getCreditUrl);
        updateCreditsDisplay(credits);

        bigGameCard.querySelector(queryClass).classList.remove('d-none');
    }

    let game = await executeGetFetch(getGamesURL);

    bigGameCard.querySelector('.game-name').innerHTML = game['title'];

    let img = bigGameCard.querySelector('img');
    img.src = game['image'];
    img.alt = `Image of ${game['title']}`

    bigGameCard.querySelector('.description').innerHTML = game['description'];

    if (isLoggedIn === 'true') {
        let loggedIn = bigGameCard.querySelector(queryClass);
        loggedIn.querySelector('p').innerHTML = `This costs ${game['cost']} credits per play`;

        let button = loggedIn.querySelector('button');

        if (game['cost'] > credits) {
            button.disabled = true;
            button.innerHTML = 'Not enough credits'
        }

        const getActiveGameURL = document.querySelector('meta[name="get-user-active-game"]').getAttribute('content');
        let activeGame = await executeGetFetch(getActiveGameURL);

        if (activeGame.length > 0) {
            gameActive = true;
            activeGameName = activeGame[0]['game_name'];

            if (game['title'].toLowerCase() !== activeGameName) {
                button.disabled = true;
                button.innerHTML = `${activeGameName} is currently active`;
            } else {
                button.innerHTML = 'Stop game';
                button.dataset.state = 'stop-button'
            }
        }

        button.addEventListener('click', handleGameStart);

        button.dataset.game = game['title'].toLowerCase();
        button.dataset.cost = game['cost'];
    } else {
        bigGameCard.querySelector('.not-logged-in').classList.remove('d-none')
    }

    gameCards.forEach(game => {
        let notLoggedInText = game.querySelector(queryClass);

        if (notLoggedInText) {
            notLoggedInText.classList.remove('d-none');
        }
    });
});

async function handleGameStart(e) {
    const gameStartBtns = document.querySelectorAll('.play-btn');
    const btn = e.target;

    if (!btn.dataset.state) {
        btn.dataset.state = 'start-button';
    }

    if (btn.dataset.state == 'start-button') {
        const startGameUrl = document.querySelector('meta[name="get-start-game"]').getAttribute('content');
        btn.innerHTML = 'Stop game'
        btn.dataset.state = 'stop-button'

        gameStartBtns.forEach(button => {
            if (button.dataset.game != btn.dataset.game) {
                button.innerHTML = 'Another game is active'
                button.disabled = true;
            }
        });

        let data = {
            game_name: btn.dataset.game,
            credits_to_deduct: btn.dataset.cost
        }

        let startGameData = await executePostFetch(startGameUrl, data);
        credits = startGameData['credits_left'];
        updateCreditsDisplay(credits);

    } else if (btn.dataset.state == 'stop-button') {
        const stopGameUrl = document.querySelector('meta[name="get-stop-game"]').getAttribute('content');
        btn.dataset.state = 'start-button'

        gameStartBtns.forEach(button => {
            if (credits >= button.dataset.cost) {
                button.disabled = false;
                button.innerHTML = 'Play game'
            } else {
                button.disabled = true;
                button.innerHTML = 'Not enough credits'

            }
        });

        let data = {
            game_name: btn.dataset.game,
        }

        let stopGameData = await executePostFetch(stopGameUrl, data);
        console.log(stopGameData);
    }
}
