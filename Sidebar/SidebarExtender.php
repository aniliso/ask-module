<?php

namespace Modules\Ask\Sidebar;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\User\Contracts\Authentication;

class SidebarExtender implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('ask::ask.title'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->route('admin.ask.question.index');
                $item->authorize(
                    $this->auth->hasAccess('ask.questions.index')
                );
//                $item->item(trans('ask::questions.title.questions'), function (Item $item) {
//                    $item->icon('fa fa-copy');
//                    $item->weight(0);
//                    $item->append('admin.ask.question.create');
//                    $item->route('admin.ask.question.index');
//                    $item->authorize(
//                        $this->auth->hasAccess('ask.questions.index')
//                    );
//                });
// append

            });
        });

        return $menu;
    }
}
