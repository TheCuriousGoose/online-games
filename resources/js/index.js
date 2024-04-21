import { executeGetFetch, updateCreditsDisplay } from "./app";

let credits = 0;

document.addEventListener('DOMContentLoaded', async () => {
    const gameCards = document.querySelectorAll('.game-card');
    const isLoggedIn = document.querySelector('meta[name="logged-in"]').getAttribute('content');
    const getGamesURL = document.querySelector('meta[name="get-games"]').getAttribute('content');
    const gamesContainer = document.getElementById('games-container');

    let queryClass = isLoggedIn === 'true' ? '.logged-in' : '.not-logged-in';

    let games = await executeGetFetch(getGamesURL);

    games.forEach(game => {
        let gameDiv = `
            <div class="col-3 mb-2 d-flex align-items-stretch">
            <div class="card">
                <img src="${game['image']}" height="300" width="300" class="card-img-top"
                    alt="Image of ${game['title']}">
                <div class="card-body">
                    <h3>${game['title']}</h3>
                    <p>
                        ${game['description']}
                    </p>
                </div>
                <div class="card-footer">
                    <a href="/games/${game['id']}" class="btn btn-primary w-100 play-btn" data-game="${game['title']}" data-cost="${game['cost']}">
                        View game
                    </a>
                </div>
                </div>
            </div>
        </div>
        `

        gamesContainer.innerHTML += gameDiv;
    })

    gameCards.forEach(game => {
        let notLoggedInText = game.querySelector(queryClass);
        notLoggedInText.classList.remove('d-none');
    });

    if (isLoggedIn === 'true') {
        const getCreditUrl = document.querySelector('meta[name="get-user-credits"]').getAttribute('content');

        credits = await executeGetFetch(getCreditUrl);
        updateCreditsDisplay(credits);

    }
});

