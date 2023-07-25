<body style="margin: 0;">
    <main class="errorPage">
        <div class="contenedotError">
            <h1 class="mensajeError">Error 404</h1>
            <div class="contenedorVInicio">
                <p>Pagina No Encontrada</p>
                <p>Porfavor presione aqui para continuar: <a href="/">Inicio</a> </p>
                
            </div>
            
        </div>
    </main>
</body>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;900&display=swap');
    p {
        margin: 0;
    }
    .errorPage {
        font-family: 'Outfit', sans-serif;
        background-color: black;
        margin: 0;
        height: 100%;
        color: white; 
        display: flex; 
        justify-content: center; 
        align-items: center;
    }
    .contenedotError {
        display: flex;
        flex-direction: row;
        gap: 3rem;
    }
    .mensajeError {
        padding: 0 2rem 0 0;
        border-right: 3px solid white;
    }
    .contenedorVInicio {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

    }
    .contenedorVInicio a {
        text-decoration: none;
        font-weight: 800;
        color: skyblue;
    }
</style>
