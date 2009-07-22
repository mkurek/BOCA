function check_alg()
{
  	var alg = document.getElementById('alg_input').value;

  	WinObj = window.opener("preview.php?data="+alg+"&cube="+cube_size, "Alg Preview", "width=300,height=200,toolbar=0,location=0,directories=0,menubar=0,status=0,scrollars=0,resizable=0");
  
}
