<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Packages;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('usuarios.index', compact('users'));
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $packages = Packages::all();
        return view('auth.register', compact('packages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('usuarios.edit', compact('user'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $custom_messages = [
            'nickname_promoter.exists' => 'El nick del promotor no existe, indique un nick correcto.'
        ];
        
        $request->validate([
            'nickname' => ['required', 'string', 'max:191', 'unique:users'],
            'nickname_promoter' => ['exists:users,nickname', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'phone' => ['required', 'string', 'max:15'],
            'package' => ['required', 'string', 'max:15', 'exists:packages,id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], $custom_messages);

        $user = User::create([
            'nickname' => $request->nickname,
            'nickname_promoter' => $request->nickname_promoter,
            'email' => $request->email,
            'phone' => $request->phone,
            'package_id' => $request->package,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191']
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->ranking = $request->ranking;
        $user->save();
        return redirect()->route('register')->with('status', 'El usuario '.$request->name.' actualizado con éxito!');
    }


    public function asignar(Request $request, User $user) {
        /* $cabezaArbol = DB::table('users')
            ->select('location')
            ->where([
                'nickname' => $user->nickname,
                ])
            ->first()->location; */

        /* Obtnemos la ubicacion (id) del arbol de su patrocinador */
        $query = DB::select('
            SELECT location FROM users WHERE nickname = (SELECT nickname_promoter FROM users WHERE nickname = :nickname)', 
            array('nickname' => $user->nickname));

        $cabezaArbol = $query[0]->location;

        
      
        // 7 niveles de profundidad
        //Empieza en 2 nodos sube hasta 64 en nivel 7

        /* EQUIPO 1 */
        $nodos = 2; 
        $total_equipo1 = 0;
        for ($nivel=1; $nivel < 7; $nivel++) { 
            $primero = $nodos * $cabezaArbol; // Formula n*a
            $ultimo =  $cabezaArbol * $nodos + $nodos / 2 - 1; // Formula a*n+n/2-1
            $nodos = $nodos*2;
            //echo $primero.'-'.$ultimo.'</br>';

            $array_rango = range($primero,$ultimo);
           /*  echo '</br>';
            var_dump($array_rango); */

            //Consultamos si hay una ubicacion con ese rango
            $items = DB::table('users')->select('location')->whereIn('location', $array_rango)->count();
            $total_equipo1+= $items;
            
            //var_dump($items);
            
        }
        echo $total_equipo1.'</br>';
        
        echo '</br>';


        /* EQUIPO 2 */
        $nodos = 2;
        $total_equipo2 = 0;
        for ($nivel=1; $nivel < 7; $nivel++) { 
            $primero =  $cabezaArbol * $nodos + $nodos / 2 ; // a*n+n/2
            $ultimo =  $cabezaArbol * $nodos + $nodos - 1 ; // a*n+n-1
            $nodos = $nodos*2;
            //echo $primero.'-'.$ultimo.'</br>';

            
            $array_rango = range($primero,$ultimo);
           /*  echo '</br>';
            var_dump($array_rango); */

            //Consultamos si hay una ubicacion con ese rango
            $items = DB::table('users')->select('location')->whereIn('location', $array_rango)->count();
            $total_equipo2+= $items;
           
            //var_dump($items);
        }

        echo $total_equipo2.'</br>';

        // Trabajamos en el equipo con menor numero de ubicaciones asignadas
        if ($total_equipo1 > $total_equipo2) {
          
        }

     
        
    }
}
