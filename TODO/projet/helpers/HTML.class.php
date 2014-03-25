<?php
class HTML {
	public function a($link,$aff)
	{
		echo "<a href=\"$link\">$aff</a>";
	}
	
	public function a2($link,$aff)
	{
		echo "<a href=\"$link\" target=\"_about\">$aff</a>";
	}
	
	public function table($tab,$ent)
	{
		echo "<table style=\"border: 1px solid black\">";
		echo "<tr><th style=\"border: 1px solid black\">nom</th><th style=\"border: 1px solid black\">prenom</th></tr>";
		foreach($tab as $val) 
		{
			echo "<tr>";
			foreach ($val as $val2)
			{
				echo "<td style=\"border: 1px solid black\">$val2</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	/*------fonction input-------*/
	
	public function input($type,$name,$options="")
	{
		echo "<input type=\"$type\" name=\"$name\"";
		if (isset($options) && !empty($options))
		{
			foreach ($options as $att=>$opt)
			{
				echo " $att=\"$opt\"";
			}
		}
		echo "/>";
	}
	/*------fonction select------*/
	
	public function select($name, $tabValeurs)
	{
		echo "<select name=\"maVariable\">";
			foreach ($tabValeurs as $att=>$opt)
			{
				echo "<option value=\"$att\">$opt</option>";
			}
		echo "</select>";
		
	}
	/*-----fonction date---------*/
	
	public function date($varJ,$varM,$varA)
	{
		echo "<select name=\"$varJ\">";
		for ($i=1; $i<=31; $i++)
		{
			echo "<option value=\"$i\">$i</option>";
		}
		echo "</select>";
		
		echo "<select name=\"$varM\">";
			echo "<option value=\"Janvier\">Janvier</option>";
			echo "<option value=\"Fevrier\">Fevrier</option>";
			echo "<option value=\"Mars\">Mars</option>";
			echo "<option value=\"Avril\">Avril</option>";
			echo "<option value=\"Mai\">Mai</option>";
			echo "<option value=\"Juin\">Juin</option>";
			echo "<option value=\"Juillet\">Juillet</option>";
			echo "<option value=\"Aout\">Aout</option>";
			echo "<option value=\"Septembre\">Septembre</option>";
			echo "<option value=\"Octobre\">Octobre</option>";
			echo "<option value=\"Novembre\">Novembre</option>";
			echo "<option value=\"Decembre\">Decembre</option>";
		echo "</select>";
		
		echo "<select name=\"$varA\">";
		for ($i=2012; $i<=2050; $i++)
		{
			if ($i==2013)
			{
				echo "<option value=\"$i\" selected>$i</option>";
			}
			else
			{
				echo "<option value=\"$i\">$i</option>";
			}
		}
		echo "</select>";
	}
}
