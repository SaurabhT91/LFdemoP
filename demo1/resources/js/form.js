
const back = document.querySelector('#back')
back.addEventListener('click', () => location.href = "/user_page.php")


const add = document.querySelector('#save')
add.addEventListener('click', () => {
    var status
    const formData = new FormData(document.querySelector('form'));
    console.log(formData.get('pwd'));
    fetch('http://localhost:7008/action_performed.php', {
            'method': "POST",
            'body': formData,
        })
        .then(res => {
            status = res.status
            return res.text()
        })
        .then(data => {
            if (status == 200)
                location.href = "/user_page.php"
        })
        .catch(err => { console.log(err) })
})