document.addEventListener("DOMContentLoaded", function() {
    // Verifica se há um parâmetro 'from' na URL
    var urlParams = new URLSearchParams(window.location.search);
    var from = urlParams.get('from');

    console.log(from);

    var loginForm = document.getElementById('loginForm');
    var NavBarHome = document.getElementById('home');
    var NavBarCriarTreino = document.getElementById('CriarTreino');

    // Atualiza o atributo 'action' do formulário com base na origem da solicitação
    if (from) {
       loginForm.action = "../controller/UserLogin.php?from=" + from;
       NavBarHome.className = 'nav-item';
       NavBarCriarTreino.className = 'nav-item active';

    } else {
        loginForm.action = "../controller/UserLogin.php";
    }
});
