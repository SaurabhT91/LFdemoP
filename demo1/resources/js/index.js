// variable 
const signup = document.getElementById('signup')
const login = document.getElementById('login')


signup.addEventListener('click', () => location.href = "/user_signup.php")

login.addEventListener('click', function() {

    var formData = new FormData(document.querySelector('form'))

    fetch('http://localhost:7008/action_performed.php', {'method': 'POST', 'body' : formData, mode: 'cors', credentials : 'include'})
    .then(res => { 
        status = res.status
        console.log('user cookies is ')
        console.log(res.headers.get('user'))
        return res.text()
    })
    .then(data =>{
        console.log(document.cookie)
        // alert(data)
        if (status == 200)
        location.href = "/index.php"
    })
    .catch(err =>{console.log(err)})

})