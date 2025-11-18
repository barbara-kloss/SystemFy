<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/telaInicial.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="background">
        <div class="bolinha bolinha1"></div>
        <div class="bolinha bolinha2"></div>
        <div class="bolinha bolinha3"></div>
        <div class="bolinha bolinha4"></div>
        <div class="bolinha bolinha5"></div>
        <div class="bolinha bolinha6"></div>

        <div class="logoCantoInferior">
            <img src="/imgFy/logoSemfundoEscritaBranca.png" alt="Logo">
        </div>
        
        <div class="fundoSemiTransparente">
            <div class="main-content-grid">

                <div class="navBar">
                    <nav>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="/client" class="active">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="/client/menu/list">Nutricional</a>
                            </li>
                            <li class="nav-item">
                                <a href="/client/exercise/list">Treinos</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="profile-box-container">
                    <a href="/client/cadastro"class="profile-link">
                        <div class="cardVerPerfil"><i class="fas fa-user"></i></div>
                        <div class="textocardVerPerfil"> Ver perfil</div>
                    </a>
                </div>

                <div class="calendar-api-container">
                    <iframe class="frame_agenda" src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=America%2FSao_Paulo&showPrint=0&mode=WEEK&src=dGhhdWFuYWZleXRoMzRAZ21haWwuY29t&src=cHQuYnJheiliYW4gI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4uYnJheiliYW4gI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&color=%23039be5&color=%230b8043&color=%230b8043%22" 
                        style="border-width:0" 
                        width="100%" height="100%" 
                        frameborder="0" 
                        scrolling="no">
                    </iframe>
                </div>

                <div class="cardMetaPeso">
                    <h3 class="titulo_peso"> Progresso Meta de Peso</h3>
                    
                    
                    <div class="gauge-container">
                        <div class="scale-label mid" style="color: #1E1E1E; top: 90px; font-size: 2.5em; font-weight: 700;">
                            <div>48</div> 
                        </div>

                        <div class="gauge-bg">
                            <div class="gauge-track"></div>
                            <div class="gauge-fill" id="gauge-fill-percentual"></div> 
                        </div>

                        <div class="scale-label min" style="font-size: 1.2em;">
                            <div>45</div> 
                        </div>
                        <div class="scale-label max" style="font-size: 1.2em;">
                            <div>58</div> 
                        </div>
                    </div>
                    </div>
                <div class="cardProgressoMetaPeso">
                    <h3 class="titulo_percentual"> Percentuais </h3>
                    
                    <div class="percentual-container">
                        
                        <div class="percentual-card">
                            <div class="percentual-titulo">Massa Corporal</div>
                            <div class="percentual-valor">%15</div>
                        </div>
                        
                        <div class="percentual-card">
                            <div class="percentual-titulo">Massa Magra</div>
                            <div class="percentual-valor">%20</div>
                        </div>
                        
                    </div>
                </div>
                </div>
        </div>
    </div>
</body>

</html>
