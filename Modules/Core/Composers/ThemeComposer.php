<?php
namespace Modules\Core\Composers;

use Illuminate\Contracts\View\View;
use Modules\Core\Foundation\Theme\ThemeManager;

class ThemeComposer
{
    /**
     * @var ThemeManager
     */
    private $themeManager;

    public function __construct(ThemeManager $themeManager)
    {
        $this->themeManager = $themeManager;
    }

    public function compose(View $view)
    {
        $view->with('themes', ['frontend' => $this->themeManager->allPublicThemes(), 'backend' => $this->themeManager->allBackendThemes()]);
    }
}
