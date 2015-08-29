<?php
namespace App\Http\Controllers;

use App\Commands\SaveShoutCommand;
use App\Http\Requests\ShoutRequest;
use App\Shout;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShoutController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        $shouts = Shout::orderBy('id', 'desc')->limit(100)->get();

        return view('index', compact('shouts'));
    }

    public function getShouts(Request $request)
    {
        $last   = $request->get('last') ?: 0;
        $shouts = Shout::where('id', '>', $last)->orderBy('id', 'desc')->limit(100)->get();

        return $shouts->transform(function (Shout $shout) {
            return [
                'id'   => $shout->id,
                'html' => view('shout', compact('shout'))->render(),
            ];
        });
    }

    public function postShout(ShoutRequest $request)
    {
        $this->dispatchFrom(SaveShoutCommand::class, $request);
    }
}
