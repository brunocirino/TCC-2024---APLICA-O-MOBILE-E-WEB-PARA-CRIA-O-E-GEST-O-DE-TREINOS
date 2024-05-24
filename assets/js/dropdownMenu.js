// Função para mostrar o dropdown
function showDropdown() {
    console.log("Mouse sobre a imagem ou o dropdown - mostrando dropdown");
    var dropdown = document.querySelector('.dropdown-perfil');
    if (dropdown) {
        dropdown.style.display = "block";
    } else {
        console.log("Elemento dropdown não encontrado");
    }
}

// Função para esconder o dropdown
function hideDropdown() {
    console.log("Mouse saiu da imagem - escondendo dropdown");
    var dropdown = document.querySelector('.dropdown-perfil');
    if (dropdown && !isMouseOverElement(dropdown)) {
        dropdown.style.display = "none";
    }
}

// Função auxiliar para verificar se o mouse está sobre o elemento
function isMouseOverElement(element) {
    return element.matches(':hover');
}

// Adicionar ouvinte de evento de mouseover ao dropdown para mantê-lo visível
document.querySelector('.dropdown-perfil').addEventListener('mouseover', showDropdown);
document.querySelector('.dropdown-perfil').addEventListener('mouseout', function() {
    hideDropdown();
    // Adicione aqui qualquer outra lógica necessária ao sair do dropdown
});

// Adicionar ouvinte de evento de mouseover à imagem .img-logado
document.querySelector('.img-logado').addEventListener('mouseover', showDropdown);
document.querySelector('.img-logado').addEventListener('mouseout', function() {
    hideDropdown();
    // Adicione aqui qualquer outra lógica necessária ao sair da imagem
});
