function menuShow(){
    let menuMobile = document.querySelector('.mobile-menu');    
    if(menuMobile.classList.contains('open')){
        menuMobile.classList.remove('open');
        document.querySelector('.icon').src = "../assets/img/menu_white_36dp.svg";
    } else{
        menuMobile.classList.add('open');
        document.querySelector('.icon').src = "../assets/img/close_white_36dp.svg";
    }


}

$(document).ready(function(){

    const sections =$('section');
    const navItems = $('.nav-item');

    $(window).on('scroll', function(){
        const header = $('header');
        let activeSecitionIndex = 0;
        const scroLLPosition = $(window).scrollTop() - header.outerHeight();

        if (scroLLPosition >= 0){
            header.css('box-shadow', 'none');
        } else{
            header.css('box-shadow', '0px 3px 10px #464646');
        }

        sections.each(function(i){
            const section = $(this);
            const sectionTop = section.offset().top - 330;
            const sectionBottom = sectionTop+ section.outerHeight();
           
            console.log(scroLLPosition);
            console.log(sectionBottom);
            
    
            if(scroLLPosition >= sectionTop && scroLLPosition < sectionBottom){
                activeSecitionIndex = i;
                return false;
            }
        })
        navItems.removeClass('active');
        $(navItems[activeSecitionIndex]).addClass('active');
    });    
});