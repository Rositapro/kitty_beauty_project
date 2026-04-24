function createSakura() {
    const sakura = document.createElement('div');
    sakura.className = 'sakura';
    sakura.style.left = Math.random() * 100 + 'vw';
    sakura.style.width = Math.random() * 10 + 10 + 'px';
    sakura.style.height = sakura.style.width;
    sakura.style.opacity = Math.random();
    sakura.style.animationDuration = Math.random() * 3 + 2 + 's'; // Velocidad variada
    
    document.body.appendChild(sakura);

    setTimeout(() => {
        sakura.remove();
    }, 5000);
}

// Crear pétalos cada 400ms para no saturar la pantalla
setInterval(createSakura, 400);