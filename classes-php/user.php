<?php

class user
{
	
	private $id = "";
	public $login = "";
	public $email = "";
	public $firstname = "";
	public $lastname = "";



	public function register($login, $password, $email, $firstname, $lastname)
	{

		$connexion=mysqli_connect("localhost", "root", "", "classes");
		$requete="SELECT * FROM user WHERE login='$login'";
		$query=mysqli_query($connexion,$requete);
		$result = mysqli_num_rows($query);
		

		if($result== 0)
		{ 	
			$requete="INSERT INTO user VALUES(NULL, '$login', '$password', '$email','$firstname','$lastname')";

			$query=mysqli_query($connexion,$requete);
			return array($login, $password, $email, $firstname, $lastname);
			
		}
		else
		{
			return "login déjà existant";
		

	}
}

public function connect($login, $password)

{

	$connexion=mysqli_connect("localhost", "root", "", "classes");
	$requete="SELECT *from user WHERE login='$login'";
	$query= mysqli_query($connexion,$requete);
	$result = mysqli_fetch_array($query);
	
		
		if(password_verify($password,$result['password'])) 
		{
			$this->id=$result['id'];
			$this->login=$login;
			$this->email=$result['email'];
			$this->firstname=$result['firstname'];
			$this->lastname=$result['lastname'];
		
			$_SESSION['login']=$login;
			$_SESSION['password']=$password;
			
			return $_SESSION['login']. ", vous êtes bien connecté";

			


		}
		else
		{
			return "Login ou mot de passe est incorrect";	

	}

}
public function disconnect()
{
	session_destroy();
	return "Vous êtes bien déconnecté";
}

public function delete()
{

	if(isset($_SESSION['login']))
	{
		$login=$_SESSION['login'];
		$connexion=mysqli_connect("localhost", "root", "", "classes");
		$requete="DELETE FROM users WHERE login='$login'";
		mysqli_query($connexion, $requete);
		session_destroy();
	}

}

public function update($login, $password, $email, $firstname,
$lastname)
{
	if(isset($_SESSION['login']))
	{
		
		$connexion=mysqli_connect("localhost", "root", "", "classes");
		$login=$_SESSION['login'];
		$update="UPDATE users SET login='$login', password='$password', email='$email', firstname='$firstname', lastname='$lastname' WHERE login='$login'";
		mysqli_query($connexion, $update);
	}
}

public function isConnected()
{
	$connected=false;
	if(isset($_SESSION['login']))
	{
		$connected=true;
	}
	else
	{
		$connected=false;
	}

	return($connected);

}


public function getAllInfos()
{
	if(isset($_SESSION['login']))
	{
        return($this);
    }
    else
    {

    	return "Aucun utilisateur n'est connecté";
    }
}

public function getLogin()
{
	 return($this->login);
}

public function getEmail()
{
	 return($this->email);
}

public function getFirstname()
{
	 return($this->firstname);
}

public function getLastname()
{
	 return($this->lastname);
}

public function refresh()
{
	$connexion=mysqli_connect("localhost", "root", "", "classes");
	$login=$_SESSION['login'];
	$query="SELECT *from users WHERE login='$login'";
	$result= mysqli_query($connexion, $query);
	$row=mysqli_fetch_array($result);

	$this->id=$row['id'];
	$this->login=$row['login'];
	$this->email=$row['email'];
	$this->firstname=$row['firstname'];
	$this->lastname=$row['lastname'];
}
}


 session_start();


 $user = new user;
 $_SESSION['user']= new user;
var_dump($_SESSION['user']->register('oui','oui','non@live.fr','oui','non'));
