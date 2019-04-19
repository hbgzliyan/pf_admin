<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fund;
use App\Models\FundCategory;
use App\Models\FundManager;
use App\Models\FundNotice;
use App\Models\Genre;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class FundNoticeController extends Controller
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
            ->header('基金公告')
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
        $grid = new Grid(new FundNotice);

        $grid->id('ID')->sortable();
        $grid->title('标题')->display(function($text) {
            return str_limit($text, 30, '...');
        });

        $grid->code('代码')->label();
        $grid->genre_id('分类')->display(function($genre_id) {
            return Genre::find($genre_id)->name;
        });
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
        $show = new Show(FundNotice::findOrFail($id));

        $show->id('ID');
        $show->title('标题');
        $show->code('基金代码')->label();
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
        $form = new Form(new FundNotice);

        $form->display('id', 'ID');
        $form->text('title', "标题")->rules('required');
        $form->text('publisher', "发布者")->rules('required');
        $form->file('doc', "文档路径")->uniqueName()->rules('required');

        $form->radio('is_zh', '专户')->options([
            0 => '不是',
            1 => '是'
        ])->stacked();

        $form->multipleSelect('code', '基金代码')->options(Fund::all()->pluck('name', 'code'));
        $form->select('genre', '公告分类')->options(Genre::all())->value(request('id'));
        $form->datetime('release_at', '发布时间')->rules('required');;
        $form->umeditor('desc', '详情')->rules('required');;

        return $form;
    }
}
