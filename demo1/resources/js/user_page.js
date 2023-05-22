function deleteLeadById(id){
  var deleteID=id;
  fetch('http://localhost:7008/action_performed.php?deleteID='+deleteID, {'method': 'DELETE'})
.then(res => res.text())
.then(data => {
    //alert(data)
    location.href = "/user_page.php"
})
}

function updateLeadById(id){

  location.href = "/form.php?id="+id;

}


const signout = document.querySelector('#signOut')
signout.addEventListener('click', () => location.href = "/logout.php")

const addLead = document.querySelector('#new_Lead')
addLead.addEventListener('click', () => location.href = "/form.php")

