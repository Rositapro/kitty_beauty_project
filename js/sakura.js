function createSakura() {
    const container = document.getElementById('sakura-container') || document.body;
    const sakura = document.createElement('div');
    sakura.className = 'sakura';
    sakura.style.left = Math.random() * 100 + 'vw';
    const size = Math.random() * 10 + 10 + 'px';
    sakura.style.width = size;
    sakura.style.height = size;
    sakura.style.opacity = Math.random() * 0.7 + 0.3;
    sakura.style.animationDuration = Math.random() * 2 + 3 + 's';
    container.appendChild(sakura);
    setTimeout(() => { sakura.remove(); }, 5000);
}
setInterval(createSakura, 300);