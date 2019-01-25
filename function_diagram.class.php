<?php
///////////////////////////////////////////////////////////////////////////////////////////
/////////// Author    : Reza Salehi
///////////	Contact   : zaalion@yahoo.com
/////////// Copyright : free for non-commercial use . 
///////////////////////////////////////////////////////////////////////////////////////////

	class function_diagram
		{
		
		//---- class properties.
		var $dimx;
		var $dimy;
		var $br;
		var $bg;
		var $bb;
		var $ar;
		var $ag;
		var $ab;
		var $function;
		var $step;
		var $hasdrid;
		var $x_points;
		var $y_points;
				
		//---- CONSTRUCTOR.
		function function_diagram($dimx, $dimy, $br, $bg, $bb, $ar, $ag, $ab, $function_t, $step, $hasgrid)
			{
			$this->dimx=(int)$dimx;
			$this->dimy=(int)$dimy;
			$this->br=(int)$br;
			$this->bg=(int)$bg;
			$this->bb=(int)$bb;
			$this->ar=(int)$ar;
			$this->ag=(int)$ag;
			$this->ab=(int)$ab;
			$this->function_t=$function_t;
			$this->step=(real)$step;
			$this->hasgrid=$hasgrid;
			}
			
		//---- some validations.
		function doler()
			{
			$this->function_t=str_replace('x','$x',$this->function_t);
			}
		function validate()
			{
			if(substr_count($this->function_t,'(')!=substr_count($this->function_t,')'))
				{
				header("Location: index.html");
				die();
				}
			}
		function yscale()
			{
			if((substr_count($this->function_t,'sin')>0)||(substr_count($this->function_t,'cos')>0))
				return(100);
			else
				return(1);
			}
		
		//----main function.
		function draw()
			{
			header("Content-type: image/jpeg");
			$image=imagecreate($this->dimx,$this->dimy+20);
			$col=imagecolorallocate($image,$this->br,$this->bg,$this->bb);
			$col1=imagecolorallocate($image,$this->ar,$this->ag,$this->ab);
			$grcol=imagecolorallocate($image,8,100,8);
			$this->validate();
			$this->doler();
			if($this->hasgrid=='1')
				{
				//---- vertical grids.
				for($i=0;$i<$this->dimx;$i+=10)
					imageline($image,$i,0,$i,$this->dimy,$grcol);
				//---- horizental grids.
				for($i=0;$i<$this->dimy;$i+=10)
					imageline($image,0,$i,$this->dimx,$i,$grcol);
				}
			imageline($image, $this->dimx/2, 0, $this->dimx/2, $this->dimy, $col1);
			imageline($image, 0, $this->dimy/2, $this->dimx, $this->dimy/2, $col1);
			
			for($x=-$this->dimx/2; $x<$this->dimx/2; $x+=$this->step)
				{
					$this->x_points[$j]=$x;
					eval('$this->y_points[$j]='.$this->yscale().'*'.$this->function_t.';');
					imagesetpixel($image,$this->x_points[$j]+$this->dimx/2,($this->y_points[$j++]*(-1))+$this->dimy/2 , $col1);			
				}
			imagestring($image, 2, 20, $this->dimy+10, str_replace('$x', 'x', $this->function_t), $col1);	
			imagejpeg($image,null,100);
			}	
		}				
?>
