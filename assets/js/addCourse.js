let btn = document.getElementById('addcourse')
let form = document.getElementById('form')
let krest = document.getElementById('krest')
btn.addEventListener('click', function () {
 form.style.display = 'flex';   
})

krest.addEventListener('click', function(){
    form.style.display = 'none'
})



