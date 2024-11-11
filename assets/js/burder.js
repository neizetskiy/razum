let burger = document.getElementById('burger')
let burgerKrest = document.getElementById('burgerKrest')
let navigation = document.querySelector('.navigation')


if(window.screen.width < 1920){


burger.addEventListener('click',function(){
    navigation.style.display = 'flex'
    burgerKrest.style.display = 'flex'
    burger.style.display = 'none'
})
burgerKrest.addEventListener('click',function(){
    navigation.style.display = 'none'
    burgerKrest.style.display = 'none'
    burger.style.display = 'flex'
})
}