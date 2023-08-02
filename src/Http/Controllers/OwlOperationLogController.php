<?php

namespace Slowlyo\OwlOperationLog\Http\Controllers;

use Slowlyo\OwlAdmin\Controllers\AdminController;
use Slowlyo\OwlOperationLog\Services\OperationLogService;

/**
 * @property OperationLogService $service
 */
class OwlOperationLogController extends AdminController
{
    protected string $serviceName = OperationLogService::class;

    public function list()
    {
        $crud = $this->baseCRUD()
            ->headerToolbar([...$this->baseHeaderToolBar()])
            ->footable()
            ->filter(
                $this->baseFilter()->body([
                    amisMake()->TextControl('path', '请求地址')->clearable()->size('md'),
                    amisMake()->SelectControl('method', '请求方法')->clearable()->size('md')->options($this->service->getModel()::METHODS),
                    amisMake()->TextControl('user', '用户')->clearable()->size('md'),
                    amisMake()->TextControl('ip', 'IP')->clearable()->size('md'),
                ])
            )
            ->columns([
                amisMake()->TableColumn('id', 'ID')->sortable(),
                amisMake()->TableColumn('path', '请求地址'),
                amisMake()->TableColumn('method', '请求方法')->type('tag')->color('${method_color}'),
                amisMake()->TableColumn('user.name', '用户'),
                amisMake()->TableColumn('ip', 'IP'),
                amisMake()->TableColumn('input', '请求数据')->breakpoint('*')->type('json'),
                amisMake()
                    ->TableColumn()
                    ->label(__('admin.created_at'))
                    ->name('created_at')
                    ->type('datetime')
                    ->sortable(true),
                $this->rowActions([
                    $this->rowDeleteButton()
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form()
    {
        return $this->baseForm()->body([
            amisMake()->TextControl()->label(__('admin.admin_role.name'))->name('name')->required(),
            amisMake()->TextControl()
                ->label(__('admin.admin_role.slug'))
                ->name('slug')
                ->description(__('admin.admin_role.slug_description'))
                ->required(),
        ]);
    }

    public function detail()
    {
        return $this->baseDetail()->body([]);
    }
}
