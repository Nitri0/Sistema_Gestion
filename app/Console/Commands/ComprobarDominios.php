<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use app\Dominios;

class ComprobarDominios extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'comprobar_dominios';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Comprueba los dominios que esta por vencerse, los que estan
								vencidos y los que ya se vencieron.';


	public function __construct()
	{
		parent::__construct();
	}


	public function fire()
	{
		
		$dominiosAunMes = Dominios::where();
		$dominiosAdosDias = Dominios::where();
		$dominiosAunDia = Dominios::where();


	}

}
