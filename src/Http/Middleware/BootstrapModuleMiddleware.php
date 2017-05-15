<?php namespace Edutalk\Base\Settings\Http\Middleware;

use \Closure;

class BootstrapModuleMiddleware
{
    public function __construct()
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  array|string $params
     * @return mixed
     */
    public function handle($request, Closure $next, ...$params)
    {
        dashboard_menu()->registerItem([
            'id' => 'edutalk-settings',
            'priority' => 1,
            'parent_id' => 'Edutalk-configuration',
            'heading' => null,
            'title' => trans('edutalk-settings::base.admin_menu.title'),
            'font_icon' => 'fa fa-circle-o',
            'link' => route('admin::settings.index.get'),
            'css_class' => null,
            'permissions' => ['view-settings'],
        ]);

        return $next($request);
    }
}
