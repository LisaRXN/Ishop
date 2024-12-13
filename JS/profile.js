

const avatars = document.querySelectorAll(".avatar-option")

avatars.forEach( (avatar) => {
    avatar.addEventListener( 'click', ()=>{

        const input = avatar.previousElementSibling;
        console.log(input)

        console.log('avatar')
        avatar.classList.add('selected')
        input.checked = true;

        avatars.forEach( (element)=>{
            if(element != avatar){
                element.classList.remove('selected')
            }
        })
    })

})
