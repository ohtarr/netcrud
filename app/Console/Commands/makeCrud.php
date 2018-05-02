<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class makeCrud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'netcrud:makeCrud {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new crud.  Provide a name and it will create all necessary files.  You will need to modify the migration and migrate it.';

    /**
     * Create a new command instance.
     *
     * @return void
     */

	public $lname = "";
	public $uname = "";

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->lname = lcfirst($this->argument('name'));
        $this->uname = ucfirst($this->argument('name'));
		$this->makeMigration();
		$this->makeModel();
		$this->makeController();
		$this->makeResource();
		$this->makeResourceCollection();
		$this->makeRequest();
		$this->makeRoute();
		$this->makePermissions();
    }

	public function makeMigration()
	{
		$name = "create" . $this->uname . "s_table";
		$this->call('make:migration', ['name'	=>	$name]);
	}

	public function makeModel()
	{
		$data = <<<END
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ServiceNowLocation;

class {$this->uname} extends BaseCrudModel
{

}
END;

	$file = "app/" . $this->uname . ".php";
	$fh = fopen($file, 'w') or die("can't open file");
	fwrite($fh, $data);
	fclose($fh);
	}

	public function makeController()
	{
		$data = <<<END
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\\{$this->uname};
use App\Http\Resources\\{$this->uname} as {$this->uname}Resource;
use App\Http\Resources\\{$this->uname}Collection;
use App\Http\Requests\Store{$this->uname};
use Validator;

class {$this->uname}Controller extends Controller
{

        public function __construct()
    {
        \$this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request \$request)
    {
                \$user = auth()->user();
                if (\$user->cant('read', {$this->uname}::class)) {
                        abort(401, 'You are not authorized');
                }

                \$params = \$request->all();
                if(\$params)
                {
                        \$query = (new {$this->uname})->newQuery();
                        foreach(\$params as \$key => \$value)
                        {
                                \$query->where(\$key,\$value);
                        }
                        return new {$this->uname}Collection(\$query->get());
                } else {
                \$models = {$this->uname}::paginate(1000);
            return new {$this->uname}Collection(\$models);
                }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  \$request
     * @return \Illuminate\Http\Response
     */
    public function store(Store{$this->uname} \$request)
    {
        \$user = auth()->user();
        if (\$user->cant('create', {$this->uname}::class)) {
            abort(401, 'You are not authorized');
        }

                return {$this->uname}::create(\$request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  \$id
     * @return \Illuminate\Http\Response
     */
    public function show(\$id)
    {
        \$user = auth()->user();
                if (\$user->cant('read', {$this->uname}::class)) {
            abort(401, 'You are not authorized');
        }

        \$model = {$this->uname}::findOrFail(\$id);
                return new {$this->uname}Resource(\$model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  \$id
     * @return \Illuminate\Http\Response
     */
    public function edit(\$id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  \$request
     * @param  int  \$id
     * @return \Illuminate\Http\Response
     */
    public function update(Request \$request, \$id)
    {
        \$user = auth()->user();
        if (\$user->cant('update', {$this->uname}::class)) {
            abort(401, 'You are not authorized');
        }

                \$model = {$this->uname}::findOrFail(\$id);
                \$model->update(\$request->all());
                return new {$this->uname}Resource(\$model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  \$id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\$id)
    {
        \$user = auth()->user();
        if (\$user->cant('delete', {$this->uname}::class)) {
            abort(401, 'You are not authorized');
        }

                \$model = {$this->uname}::findOrFail(\$id);
                \$model->delete();
                return new {$this->uname}Resource(\$model);
    }

        public function filter(Request \$request)
        {
                \$user = auth()->user();
        if (\$user->cant('read', {$this->uname}::class)) {
            abort(401, 'You are not authorized');
        }

        }
}
END;

		$file = "app/Http/Controllers/" . $this->uname . "Controller.php";
		$fh = fopen($file, 'w') or die("can't open file");
		fwrite($fh, $data);
		fclose($fh);
	}

	public function makeResource()
	{
		$data = <<<END
<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class {$this->uname} extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  \$request
     * @return array
     */

    public function toArray(\$request)
    {
        return parent::toArray(\$request);
    }

}
END;

		$file = "app/Http/Resources/" . $this->uname . ".php";
		$fh = fopen($file, 'w') or die("can't open file");
		fwrite($fh, $data);
		fclose($fh);
	}

	public function makeResourceCollection()
	{
		$data = <<<END
<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class {$this->uname}Collection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  \$request
     * @return array
     */
    public function toArray(\$request)
    {
        return parent::toArray(\$request);
    }

}
END;

        $file = "app/Http/Resources/" . $this->uname . "Collection.php";
        $fh = fopen($file, 'w') or die("can't open file");
        fwrite($fh, $data);
        fclose($fh);
	}

	public function makeRequest()
	{
		$data = <<<END
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Store{$this->uname} extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			//'part_id'       =>      'required',
        ];
    }
}
END;

        $file = "app/Http/Requests/Store" . $this->uname . ".php";
        $fh = fopen($file, 'w') or die("can't open file");
        fwrite($fh, $data);
        fclose($fh);
	}

	public function makeRoute()
	{
		$route = "\\\t'" . $this->lname . "s'\\\t\\\t=>\\\t'" . $this->uname . "Controller',";
		$cmd = "sed -i \"/END-OF-RESOURCE-ROUTES/ i $route\" routes/api.php";
		exec($cmd);
	}

	public function makePermissions()
	{
		$type = '\\' . '\\' . '\t' . 'App' . '\\' . '\\' . '\\' . $this->uname . '::class,';
        $cmd = "sed -i \"/END-OF-PERMISSION-TYPES/ i $type\" app/Console/Commands/setPermissions.php";
		exec($cmd);
        $this->call('netcrud:setPermissions');
	}
}

