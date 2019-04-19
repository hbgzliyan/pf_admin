<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fund;
use App\Models\FundCategory;
use App\Models\FundManager;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class FundController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('基金列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('详细')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('修改')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('添加')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Fund);

        $grid->id('ID')->sortable();
        $grid->name('基金名称');
        $grid->code('基金代码');
//        $grid->category_id('基金类别')->pluck('name')->label();
        $grid->type('基金类型');
        $states = [
            'on' => ['text' => 'YES'],
            'off' => ['text' => 'NO'],
        ];

        $grid->column('switch_group')->switchGroup([
            'recommend' => '推荐', 'hot' => '热销', 'new' => '最新'
        ], $states);

        $grid->risk_level('基金风险');
        $grid->created_at('创建时间');
        $grid->updated_at('修改时间');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Fund::findOrFail($id));

        $show->id('ID');
        $show->name('基金名称');
        $show->code('基金代码');
        $show->type('基金类型');
        $show->risk_level('基金风险');
        $show->found_date('成立时间');
        $show->created_at('创建时间');
        $show->updated_at('修改时间');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Fund);

        $form->display('id', 'ID');
        $form->text('name', "基金名称");
//        $form->select('category_id','基金类别')->options(FundCategory::all()->pluck('name', 'id'));
        $form->text('code', "基金代码");
        $form->text('type', '基金类型');
        $form->text('risk_level', '风险等级');
        $form->datetime('found_date', '成立时间');
        $form->multipleSelect('fand_manager_ids','基金经理')->options(FundManager::all()->pluck('name', 'id'));
        $form->textarea('target', '投资目标')->rules('required');
        $form->textarea('idea', '投资理念')->rules('required');
        $form->textarea('range', '投资范围')->rules('required');
        $form->textarea('compref', '业绩比较基准')->rules('required');
        $form->textarea('risk_return_charact', '风险收益特征')->rules('required');
        $form->textarea('risk_management_tools', '风险管理工具')->rules('required');

        return $form;
    }
}
