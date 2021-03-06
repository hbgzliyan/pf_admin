<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fund;
use App\Models\FundCategory;
use App\Models\FundGroup;
use App\Models\FundManager;
use App\Models\FundNotice;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class FundGroupController extends Controller
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
            ->header('基金组合')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
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
     * @param mixed $id
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
        $grid = new Grid(new FundGroup);

        $grid->id('ID')->sortable();
        $grid->title('标题')->display(function($text) {
            return str_limit($text, 30, '...');
        });
        $grid->code('基金代码');
        $grid->release_at('发布时间');
        $grid->created_at('创建时间');
        $grid->updated_at('修改时间');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(FundGroup::findOrFail($id));

        $show->id('ID');
        $show->title('标题');
        $show->code('基金代码');
        $show->release_at('发布时间');
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
        $form = new Form(new FundGroup);

        $form->display('id', 'ID');
        $form->text('title', "标题")->rules('required');;
        $form->select('code', '基金代码')->options(Fund::all()->pluck('name', 'code'));
        $form->datetime('release_at', '发布时间')->rules('required');;
        $form->umeditor('desc', '详情')->rules('required');;

        return $form;
    }
}
