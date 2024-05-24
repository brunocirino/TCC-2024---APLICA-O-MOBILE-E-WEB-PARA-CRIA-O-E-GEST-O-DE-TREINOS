function abrirFechar(identificador){

    

    var inputs_Linha1 = document.querySelector('.input-group-pessoal');
    var inputs_Linha2 = document.querySelector('.input-group-login');
    var inputs_Linha3 = document.querySelector('.input-group-endereco');

    var subTitulo_Linha1 = document.querySelector('.SubTitulo-1');
    var subTitulo_Linha2 = document.querySelector('.SubTitulo-2');
    var subTitulo_Linha3 = document.querySelector('.SubTitulo-3');


    
    if(identificador == '1'){
        if(inputs_Linha1.style.display == 'none'){
            inputs_Linha1.style.display = 'flex';
            
            subTitulo_Linha1.style.boxShadow = 'none';
        }else{
            inputs_Linha1.style.display = 'none';
            subTitulo_Linha1.style.boxShadow = '1px 1px 6px #f78113';
            subTitulo_Linha1.style.borderRadius = '10px';
        }
        
    }

    if(identificador == '2'){

        console.log('entrei')   
        if(inputs_Linha2.style.display == 'none'){
            inputs_Linha2.style.display = 'flex';
            console.log(subTitulo_Linha2);
            subTitulo_Linha2.style.boxShadow = 'none';
        }else{
            console.log(inputs_Linha2);
            inputs_Linha2.style.display = 'none';
            subTitulo_Linha2.style.boxShadow = '1px 1px 6px #f78113';
            subTitulo_Linha2.style.borderRadius = '10px';
        }
        
    }if(identificador == '3'){
        if(inputs_Linha3.style.display == 'none'){
            inputs_Linha3.style.display = 'flex';
            subTitulo_Linha3.style.boxShadow = 'none';
        }else{
            inputs_Linha3.style.display = 'none';
            subTitulo_Linha3.style.boxShadow = '1px 1px 6px #f78113';
            subTitulo_Linha3.style.borderRadius = '10px';
        }
    }
}


document.addEventListener("DOMContentLoaded", function() {

    $(document).on('click', '.linha1', function(){
        abrirFechar('1');   
    });

    $(document).on('click', '.linha2', function(){
        abrirFechar('2');   
    });

    $(document).on('click', '.linha3', function(){
        abrirFechar('3');   
    });

});