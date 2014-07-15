<?php
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateReservationStatus extends Command{
	 /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'command:updatereservationstatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Azuriranje statusa rezervacije.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        /*$affrows = Reservation::where('start_date', '<=', new DateTime('today'))->update(array('status' => 'Realizovana'));
        echo $affrows;*/
        
        echo "SUCCESS";
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('example', InputArgument::REQUIRED, 'An example argument.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }
}