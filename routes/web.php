<?php
use Illuminate\Support\Str;

app()->singleton('random',function(){
    return Str::random(8);
});

dump(app()->make('random'));
dd(app(),app()->make('random'));


// #######################################
class Studiam{}
class Football{
    public $sutdiam;
    public function __construct(Studiam $sutdiam){
        $this->sutdiam = $sutdiam;
    }
}
class Game{
    public $football;
    public function __construct(Football $football){
        $this->football = $football;
    }
}

// app()->bind('Game',function(){
//     return new Game(new Football(new Studiam));
// });
// dd(app()->make('Game'));

//****** The ReflectionClass class */
dd(resolve('Game') ,app());


dd(app());

Route::get('/container',function(){

    class Container{

        protected $binding = [];

        public function bind($name , callable $resolver){
            $this->binding[$name] = $resolver;
        }
        public function make($name){
            return  $this->binding[$name]() ;
        }

    }

    $container = new Container;
    $container->bind('Game',function(){
        return 'Football';
    });
    dd($container->make('Game'));

});



Route::get('/', function () {
    return view('welcome');
});
