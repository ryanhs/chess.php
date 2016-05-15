<?php

namespace Ryanhs\Chess;

class Chess
{
	
	
	
	public function moves()
	{
		return []
	}
	
	public function move($move)
	{
		
	}
	
	
	
	
	public function gameOver()
	{
		return mt_rand(0, 1) == 1;
	}
	
	
	
	public function __toString()
	{
		return $this->ascii();
	}
	
	public function ascii()
	{
		return '---';
	}
}
