<?php

namespace Shoppvel\Http\Controllers\Auth;

use Shoppvel\User;
use Validator;
use Shoppvel\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/cliente/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'cpf' => 'required|cpf',
            'endereco' => 'required',
            'senha' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        // retira pontos e traços do cpf pois eh melhor 
        // gravar sem formatação para garantir padronização dos dados
        $cpf = $data['cpf'];
        $cpf = str_replace('.', '', $cpf);
        $cpf = str_replace('-', '', $cpf);
        
        return User::create([
            'name' => $data['nome'],
            'email' => $data['email'],
            'cpf' => $cpf,
            'endereco' => $data['endereco'],
            'password' => bcrypt($data['senha']),
        ]);
    }
    
   
    /**
     * Sobrescreve o método register do trait de registo original do Laravel
     * para gerenciar os redirecionamentos de acordo com o local que está sendo 
     * executado o registro, assim se vem de um pedido de pagar conta redireciona
     * para o pagamento, senão para o dashboard do cliente
     * 
     * @param \Shoppvel\Request $request
     * @return type
     */
    public function register(Request $request) {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                    $request, $validator
            );
        }

        Auth::guard($this->getGuard())->login($this->create($request->all()));

        
        return redirect($this->redirectPath());
    }

    /** 
     * sobrescreve o método authenticated para testar qual layout mostrar
     */
    public function authenticated($request, $user ) {
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->intended($this->redirectPath());
    }
    public function recuperaSenha(Request $request){
     $user=User::where('email','LIKE',$request->email)->first();
       $data['id']=$user->id;
       $data['name']=$user->name;
       $data['email']=$user->email;
       $data['token']=$user->remember_token;
       Mail::send('mail.recuperasenha',['data'=>$data], function($mail) use ($data) {
         $mail->to($data['email']) ->subject('Redefinição de senha Shopvel');
       });
       \Session::flash('mensagens-sucesso', 'Um email foi enviado para a caixa '.$data['email'].'!!');
        return back();
    }

    public function alteraSenha(Request $request){
        User::find($request->id)->update([
                'password' => bcrypt($request->senha)
            ]);
        \Session::flash('mensagens-sucesso', 'Senha alterada com sucesso!!');
       return back();
    }

    
}
