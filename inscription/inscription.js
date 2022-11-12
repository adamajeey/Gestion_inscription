function validation() {

  let user= document.getElementById('user').value;
  let password= document.getElementById('password').value;
  let Confirmpassword= document.getElementById('Confirmpassword').value;
  let mobilenumber= document.getElementById('mobilenumber').value;
  let email= document.getElementById('mail').value;
  let regex = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
  let nom= document.getElementById('nom').value;
  
  
  
  
    if (user.trim() == "") {
    document.getElementById('username').innerHTML ="Veuillez remplir ce champ svp!";
    setTimeout(() => {
      document.getElementById("username").innerHTML =""; 
      }, 2000);
    return false;           
  }
   if ((user.length <=2)  ||  (user.length >=200)) {
     document.getElementById('username').innerHTML ="Le prenom d'utilisateur doit comporter entre 2 et 200 caractères "
     setTimeout(() => {
      document.getElementById("username").innerHTML =""; 
      }, 2000);
   }else if (!isNaN(user)) {
      document.getElementById('username').innerHTML = ""
   }
  
   if (nom.trim() == "") {
    document.getElementById('users').innerHTML ="Veuillez remplir ce champ svp!";
    setTimeout(() => {
      document.getElementById("users").innerHTML =""; 
      }, 2000);
    return false;        
  }
   if ((nom.length <=2)  ||  (nom.length >=200)) {
     document.getElementById('users').innerHTML ="Le nom d'utilisateur doit comporter entre 2 et 200 caractères ";
     setTimeout(() => {
      document.getElementById("users").innerHTML =""; 
      }, 2000);
   }else if (!isNaN(nom)) {
      document.getElementById('users').innerHTML = ""
   };
  
  
  if (password == "") {
    document.getElementById('passwordid').innerHTML ="Veuillez remplir ce champ svp!"
    setTimeout(() => {
      document.getElementById("passwordid").innerHTML =""; 
      }, 2000);
     return false;
      }else if ((password.length <=4)  ||  (password.length >=200)) {
       document.getElementById('passwordid').innerHTML ="le mot de passe utilisateur doit comporter entre 4 et 200 caractères"
       setTimeout(() => {
        document.getElementById("passwordid").innerHTML =""; 
        }, 2000);
        return false;
      }
  
      if (Confirmpassword == "") {
         document.getElementById('Confirmpasswordid').innerHTML ="Confirmer le mot de passe"
         setTimeout(() => {
          document.getElementById("Confirmpasswordid").innerHTML =""; 
          }, 2000);
         return false;
         }else if (password!= Confirmpassword) {
           document.getElementById('Confirmpasswordid').innerHTML ="Le mot de passe ne correspond pas"
           setTimeout(() => {
            document.getElementById("Confirmpasswordid").innerHTML =""; 
            }, 2000);
            return false;
         }

       if (email==" " || email =="") {
          document.getElementById("emailid").innerHTML ="Veuillez remplir ce champ svp!";
          setTimeout(() => {
          document.getElementById("emailid").innerHTML =""; 
          }, 2000);
          return false;
      } 
      if (!email.match(regex)){
        document.getElementById('emailid').innerHTML = "L'adresse email incorrect!";
          document.getElementById('emailid').style.color = 'red';
          setTimeout(() => {
            document.getElementById("emailid").innerHTML =""; 
            }, 2000);
            return false;
      }
  
      if (mobilenumber.trim() == "") {
            document.getElementById("MobileNumberid").innerHTML ="Veuillez remplir ce champ svp!";
            setTimeout(() => {
              document.getElementById("MobileNumberid").innerHTML =""; 
              }, 2000);
          return false;
      }
   }



