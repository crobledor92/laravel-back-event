@include('common/session')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Back Event</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <style>
    @keyframes moveInTop {
        0% {
            opacity: 0;
            transform: translateY(-500px);
        }

        80% { 
            transform: translateY(10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes moveInBottom {
        0% {
            opacity: 0;
            transform: translateY(500px);
        }

        80% { 
            transform: translateY(-10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .section-intro {
        height: 100vh;
        text-align:center;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .title{
        color: #0a2512;
        text-transform: uppercase;
        backface-visibility: hidden;
        font-weight: 400;
        letter-spacing: 35px;
        animation: moveInTop 1s ease-out;
        }
    .heading {
        font-size: 3.5rem;
        text-transform: uppercase;
        font-weight: 700;
        display: inline-block;
        background-image: linear-gradient(to right, #32cd32, #0a2512);
        -webkit-background-clip: text;
        color: transparent;
        letter-spacing: 2px;
        transition: all .2s;
        animation: moveInBottom 1s ease-out;
    }
    .row {
    max-width:60rem;
    margin: 0 auto;
    }
    .row:not(:last-child) {
    margin-bottom: 8rem;
    }
    .row::after {
    content: "";
    display: table;
    clear: both;
    }
    .row [class^=col] {
    float: left;
    }
    .row [class^=col]:not(:last-child) {
    margin-right: 3rem;
    }
    .row .col {
    width: calc((100% - 2 * 3rem) / 3);
    }
    .feature-box {
        min-height: 220px;
        text-align: center;
        background-color: rgba(255, 255, 255, 0.8);
        font-size: 1.5rem;
        padding: 2rem;
        border-radius: 3px;
        box-shadow: 0 1.5rem 4rem rgba(0, 0, 0, 0.15);
        transition: transform 0.3s;
        display: flex;
        align-items: center;
    }
    .feature-box:hover {
        transform: translateY(-1.5rem) scale(1.03);
    }
    .section-features {
        padding: 10rem 0;
        background-image: linear-gradient(to right bottom, rgba(126, 213, 111, 0.8),  rgba(40, 180, 133, 0.8)), url(img/fondo.jpg);
        background-size: cover;
        transform: skewY(-7deg);
        z-index: -1;
    }
    .section-features > * {
    transform: skewY(7deg);
    }
    </style>
</head>
    @include('common/navegation')
    <main>
        <section class="section-intro">
            <h1 class="title">Back Event</h1>
            <h2 class='heading'>El portal en el que conectar con la tecnología</h2>
        </section>
        <section class="section-features">
            <div class='row'>
                <div class='col'>
                    <div class="feature-box">   
                        <p class="feature-text">
                            Explora todos los eventos, conoce sus horarios y descubre a los ponentes destacados
                        </p> 
                    </div>
                </div>
                <div class='col'>
                    <div class="feature-box">
                        <p class="feature-text">
                            Regístrate para participar en los eventos que te interesen
                        </p> 
                    </div>
                </div>
                <div class='col'>
                    <div class="feature-box">
                        <p class="feature-text">
                            Mantén un seguimiento de los eventos a los que te has inscrito
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>