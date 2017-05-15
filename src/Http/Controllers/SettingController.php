<?php namespace Edutalk\Base\Settings\Http\Controllers;

use Edutalk\Base\Http\Controllers\BaseAdminController;

use Edutalk\Base\Settings\Repositories\Contracts\SettingContract;

class SettingController extends BaseAdminController
{
    protected $module = 'edutalk-settings';

    /**
     * @var \Edutalk\Base\Settings\Repositories\SettingRepository
     */
    protected $repository;

    public function __construct(SettingContract $settingRepository)
    {
        parent::__construct();

        $this->repository = $settingRepository;

        $this->middleware(function ($request, $next) {
            $this->breadcrumbs->addLink(trans('edutalk-settings::base.settings'), route('admin::settings.index.get'));

            return $next($request);
        });
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle(trans('edutalk-settings::base.settings'));

        $this->getDashboardMenu($this->module);

        $this->assets
            ->addStylesheets('bootstrap-tagsinput')
            ->addJavascripts('bootstrap-tagsinput');

        return do_filter(BASE_FILTER_CONTROLLER, $this, EDUTALK_SETTINGS, 'index.get')->viewAdmin('index');
    }

    /**
     * Update settings
     * @method POST
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $data = $this->request->except([
            '_token',
            '_tab',
        ]);

        $data = do_filter(BASE_FILTER_BEFORE_UPDATE, $data, EDUTALK_SETTINGS, 'edit.post');

        $result = $this->repository->updateSettings($data);

        do_action(BASE_ACTION_AFTER_UPDATE, EDUTALK_SETTINGS, $data, $result);

        $msgType = !$result ? 'danger' : 'success';
        $msg = $result ? trans('edutalk-core::base.form.request_completed') : trans('edutalk-core::base.form.error_occurred');

        flash_messages()
            ->addMessages($msg, $msgType)
            ->showMessagesOnSession();

        return redirect()->back();
    }
}
