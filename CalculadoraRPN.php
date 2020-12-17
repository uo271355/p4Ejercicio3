<!DOCTYPE  html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Calculadora RPN</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="CalculadoraRPN.css">
</head>
<body>
<h1>Calculadora RPN</h1>
<section>
<pre>
<code>
<?php
class CalculadoraRPN{
	protected $pila;
	
	public function __construct(){
		session_start();
		 if(isset( $_SESSION['pila'])){                
            
		}else{
            $_SESSION['pila'] = array();
        }
	}
	public function digitos(){
		if (count($_POST)>0) { 
			 if(isset($_POST["0"])){
                $this->digit(0);
             }else if(isset($_POST["1"])){
                $this->digit(1);
             }else if(isset($_POST["2"])){
                $this->digit(2);
             }else if(isset($_POST["3"])){
                $this->digit(3);
             }else if(isset($_POST["4"])){
                $this->digit(4);
             }else if(isset($_POST["5"])){
                $this->digit(5);
             }else if(isset($_POST["6"])){
                $this->digit(6);
             }else if(isset($_POST["7"])){
                $this->digit(7);
             }else if(isset($_POST["8"])){
                $this->digit(8);
             }else if(isset($_POST["9"])){
                $this->digit(9);
             }else if(isset($_POST["numeropi"])){
				 $this->digit(pi());
			 }else if(isset($_POST["+"])){
                $this->suma();
             }else if(isset($_POST["-"])){
                $this->resta();
             }else if(isset($_POST["*"])){
                $this->multiplicacion();
             }else if(isset($_POST["/"])){
                $this->division();
             }else if(isset($_POST["raiz"])){
                $this->raiz();
             }else if(isset($_POST["log"])){
                $this->logaritmica();
             }else if(isset($_POST["exp"])){
                $this->exponencial();
             }else if(isset($_POST["sin"])){
                $this->seno();
             }else if(isset($_POST["cos"])){
                $this->coseno();
             }else if(isset($_POST["tan"])){
                $this->tangente();
             }else if(isset($_POST["pow2"])){
                $this->pow2();
             }else if(isset($_POST["C"])){
                $this->vacia();
             }else if(isset($_POST["CE"])){
                $this->desapilar();
             }else if(isset($_POST["borrar"])){
                $this->borrar();
             }else if(isset($_POST["masymenos"])){
                $this->masymenos();
             }else if(isset($_POST["punto"])){
                $this->digit('.');
             }else if(isset($_POST["enter"])){
                $this->enter();
             }else if(isset($_POST["fact"])){
                $this->factorial();
             }
		}
	}
	public function factorial(){
		$valor1= $this->desapilar();
		$contador=0;
		$result=1;
		while($valor1!=$contador){
			$result=$result*($contador+1);
			$contador++;
		}
		$this->apilar($result);
	}
	
	public function ver(){
		if(isset($_SESSION["calculadorarpn"])){
			return $_SESSION["calculadorarpn"];
		}
    }
	public function borrar(){
		$_SESSION["calculadorarpn"]="";
		
    }
	public function masymenos(){
		$valor1= $this->desapilar();
		$result=-($valor1);
		$this->apilar($result);
    }
	public function seno(){
		$valor1= $this->desapilar();
		$result=sin($valor1);
		$this->apilar($result);
    }
	public function coseno(){
		$valor1= $this->desapilar();
		$result=cos($valor1);
		$this->apilar($result);
    }
	public function tangente(){
		$valor1= $this->desapilar();
		$result=tan($valor1);
		$this->apilar($result);
    }
	public function raiz(){
		$valor1= $this->desapilar();
		$result=sqrt($valor1);
		$this->apilar($result);
    }
	public function logaritmica(){
		$valor1= $this->desapilar();
		$result=log($valor1);
		$this->apilar($result);
    }
	public function exponencial(){
		$valor1= $this->desapilar();
		$result=exp($valor1);
		$this->apilar($result);
    }
	public function pow2(){
		$valor1= $this->desapilar();
		$result=pow($valor1,2);
		$this->apilar($result);
    }
	public function suma(){
		$valor1= $this->desapilar();
		$valor2= $this->desapilar();
		$result=$valor2+$valor1;
		$this->apilar($result);
    }
	public function resta(){
		$valor1= $this->desapilar();
		$valor2= $this->desapilar();
		$result=$valor2-$valor1;
		$this->apilar($result);
    }
	public function multiplicacion(){
		$valor1= $this->desapilar();
		$valor2= $this->desapilar();
		$result=$valor2*$valor1;
		$this->apilar($result);
    }
	public function division(){
		$valor1= $this->desapilar();
		$valor2= $this->desapilar();
		$result=$valor2/$valor1;
		$this->apilar($result);
    }
	public function digit($digito){
		if(isset($_SESSION["calculadorarpn"])){
			$_SESSION["calculadorarpn"] .= strval($digito);
		}else{
			$_SESSION["calculadorarpn"] = strval($digito);
		}
	}
	
	public function apilar($elemento) {
		if(isset( $_SESSION['pila'])){  
			array_unshift($_SESSION['pila'],$elemento);          
		}else{
			$_SESSION['pila'] = array();
		}
        
    }
	public function enter(){
        if(isset($_SESSION["calculadorarpn"])){
            $this->apilar(floatval($_SESSION["calculadorarpn"]));
            $_SESSION["calculadorarpn"] = "";
        }
  
	}
	public function vacia() {
		$pila = $_SESSION['pila'];
		foreach ($pila as $valor) {
			$this->desapilar();
		}
		
	
    }
	public function longitud(){
            if(isset($_SESSION["pila"])){
                return count($_SESSION["pila"]);
            }   
        }   
   	  public function mostrarPila(){
		   $string = "";
		    $length = $this->longitud();
            if($length>0){  
				$contador = $length;
				for ($i = $length - 1; $i >= 0; $i--	){ 
                    if(isset($_SESSION["pila"])){
                        $string .= "<p>" . $contador . ": " .  $_SESSION["pila"][$i] . "</p>";
						$contador -= 1;
                    } 
                } 
            }
            return $string;
        }
	 public function desapilar() {
       if(isset( $_SESSION['pila'])){
            if(empty($_SESSION['pila'])){
            
			}else{
                return array_shift($_SESSION['pila']);
            }          
        }else{
			$_SESSION['pila'] = array();
        }
    }
}
$calculadoraRPN=new CalculadoraRPN();
$calculadoraRPN->digitos();
?>
</code>
</pre>
</section>
<section class='calculadora'>
<form action='#' method='post' name='botones'>
<div id='p'>
<?php echo $calculadoraRPN->mostrarPila();?>
</div>
<input type='text' title='pantalla' class='pantalla' name='pantalla'  value="<?php 
echo $calculadoraRPN->ver();?>" readOnly />
<div>
<input type='submit' class='button' name='pow2' value='x²'/>
<input type='submit' class='button' name='raiz' value='√'/>
<input type='submit' class='button' name='log' value='log'/>
<input type='submit' class='button' name='exp' value='exp'/>
<input type='submit' class='button' name='numeropi' value='π'/>
</div>
<div>
<input type='submit' class='button' name='fact' value='n!'/>
<input type='submit' class='button' name='C' value='C'/>
<input type='submit' class='button' name='CE' value='CE'/>
<input type='submit' class='button' name='borrar' value='-'/>
<input type='submit' class='button' name='/' value='/'/>
</div>
<div>
<input type='submit' class='button' name='sin' value='sin'/>
<input type='submit' class='button' name='7' value='7'/>
<input type='submit' class='button' name='8' value='8'/>
<input type='submit' class='button' name='9' value='9'/>
<input type='submit' class='button' name='*' value='x'/>
</div>
<div>
<input type='submit' class='button' name='cos' value='cos'/>
<input type='submit' class='button' name='4' value='4'/>
<input type='submit' class='button' name='5' value='5'/>
<input type='submit' class='button' name='6' value='6'/>
<input type='submit' class='button' name='-' value='-'/>
</div>
<div>
<input type='submit' class='button' name='tan' value='tan'/>
<input type='submit' class='button' name='1' value='1'/>
<input type='submit' class='button' name='2' value='2'/>
<input type='submit' class='button' name='3' value='3'/>
<input type='submit' class='button' name='+' value='+'/>
</div>
<div>
<input type='submit' class='button' name='masymenos' value='+-'/>
<input type='submit' class='button' name='0' value='0'/>
<input type='submit' class='button' name='punto' value='.'/>
<input type='submit' class='enter' name='enter' value='Enter'/>
</div>
</form>
</section>
</body>
</html>
