
const backb = document.querySelector('#back-btn')
backb.addEventListener('click', () => location.href = "/index.php")


const signUp = document.querySelector('#save')
signUp.addEventListener('click', () => {
    var status
    const formData = new FormData(document.querySelector('form'));
    console.log(formData.get('pwd'));
    fetch('http://localhost:8000/app/Http/Controllers/action_performed.php', {
            'method': "POST",
            'body': formData,
        })
        .then(res => {
            status = res.status
            return res.text()
        })
        .then(data => {
            alert(data)
            if (status == 200)
                location.href = "./index.php"
        })
        .catch(err => { console.log(err) })
})