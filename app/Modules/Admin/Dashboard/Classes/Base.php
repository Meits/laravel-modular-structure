<?php
/**
 * Created by PhpStorm.
 * User: MeitsWorkPc
 * Date: 12.09.2019
 * Time: 21:40
 */

namespace App\Modules\Admin\Dashboard\Classes;


use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Base extends Controller
{

    /**
     *
     * @var String $title
     */
    protected $vars = array();

    /**
     *
     * @var String $title
     */
    protected $title = FALSE;

    /**
     *
     * @var String $description
     */
    protected $description = FALSE;

    /**
     *
     * @var String $template
     */
    protected $template = FALSE;


    /**
     *
     * @var String $locale
     */
    protected $locale;

    /**
     *
     * @var String $user
     */
    protected $user;

    /**
     *
     * @var String $content
     */
    protected $content;

    /**
     *
     * @var String $sideBar
     */
    protected $sideBar;

    /**
     * Base constructor.
     */
    public function __construct() {

        $this->template = 'Admin::Dashboard.dashboard';

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    /**
     *@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    protected function renderOutput() : View {

        //render view
        $menu = null;//$this->getMenu();
        $photo = null;//Setting::where('field','system_photo')->first()->value;

        if(!$this->sideBar) {
            $this->sidebar = view('Admin::layouts.parts.sidebar')->with(['menu'=>$menu, 'photo' => $photo, 'user' => Auth::user()])->render();
        }

        $this->vars = Arr::add($this->vars, 'sidebar', $this->sidebar);
        $this->vars = Arr::add($this->vars, 'content', $this->content);

        return view($this->template)->with($this->vars);
    }
}