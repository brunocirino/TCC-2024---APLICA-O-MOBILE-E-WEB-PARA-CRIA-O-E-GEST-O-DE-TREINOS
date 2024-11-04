const tabs = document.querySelectorAll('.tab-btn');

tabs.forEach(tab => tab.addEventListener('click', () => tabclicked(tab)))

const tabclicked = (tab) => {
    tabs.forEach(tab => tab.classList.remove('active'));

    tab.classList.add('active');


    const conteudos = document.querySelectorAll('.conteudo');

    conteudos.forEach(conteudo => conteudo.classList.remove('show'));

    const conteudoid = tab.getAttribute('content-id');

    const content = document.getElementById(conteudoid);

    content.classList.add('show');

    
}

const selectElement = document.getElementById('grupo1');

selectElement.addEventListener('change', function() {
    const selectedValue = selectElement.value; // Pega o valor selecionado
    
    // Aqui você pode chamar outras funções ou manipular o DOM com base no treino selecionado
});