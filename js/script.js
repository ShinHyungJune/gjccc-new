$(document).ready(function(){
    //헤더 푸터 컴포넌트
    $('#header').load('components/header.html');
    $('#footer').load('components/footer.html');
    
})

$(document).ready(function() {
    $(".now_Language_wrap").click(function() {
        $(".translation_wrap").toggleClass("open");
    });

    $(".Language_list li").click(function() {
        const imgSrc = $(this).find("img").attr("src");
        const languageName = $(this).text().trim();

        $(".now_Language").html(`<img src="${imgSrc}" alt=""><p>${languageName}</p>`);
        $(".translation_wrap").removeClass("open");
    });
});