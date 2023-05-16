<?php
use App\Models\Agendamentos;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/consulta', function (){
    $agendamentos = Agendamentos::all();
    return view('consulta', ['agendamentos' => $agendamentos]);
});
Route::post('/registrar', function (){

    $agendamentos = new Agendamentos;
    $agendamentos->nome = $_POST['txtNome'];
    $agendamentos->telefone = $_POST['txtTelefone'];
    $agendamentos->origem = $_POST['txtOrigem'];
    $agendamentos->data_contato = $_POST['txtDataContato'];
    $agendamentos->observacao = $_POST['txtObservacao'];

    $agendamentos->save();

    echo "<script>alert('Registro incluído com sucesso!');document.location='../'</script>";
});

Route::get('/editar', function(){
    $i = $_GET['i'];
    $agendamentos = Agendamentos::all();

    foreach($agendamentos as $agendamento){
        if($i == $agendamento->id){
            $nome = $agendamento->nome;
            $telefone = $agendamento->telefone;
            $origem = $agendamento->origem;
            $data_contato = $agendamento->data_contato;
            $observacao = $agendamento->observacao;   
        }
    }

    return view('editar', ['i' => $i,'nome' => $nome, 'tel' => $telefone, 'orig' => $origem,'data' => $data_contato,'obs' => $observacao]);
});
Route::post('/atualizar', function(){
    $i = $_GET['i'];
    $agendamentos = new Agendamentos;
    $agendamentos->where('id',$i)->update(['nome' => $_POST['txtNome'], 'telefone' => $_POST['txtTelefone'], 'origem' => $_POST['txtOrigem'], 'data_contato' => $_POST['txtDataContato'], 'observacao' => $_POST['txtObservacao']]);
    echo "<script>alert('Registro atualizado com sucesso!');document.location='../consulta'</script>";
});
Route::get('/excluir', function(){
    $i = $_GET['i'];
    $agendamentos = new Agendamentos;
    $agendamentos->where('id',$i)->delete();
    echo "<script>alert('Registro excluído com sucesso!');document.location='../consulta'</script>";
});