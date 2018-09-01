<?php

namespace App\Admin\Controllers;

use App\Models\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {

        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     * 页面显示的表格
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('会员姓名');
           // $grid->email('邮箱');
            $grid->column('email','邮箱');
            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');

            //添加多个字段
           // $grid->columns('test1', 'test2');

            //设置搜索框
            $grid->filter(function ($filter) {

                //添加时间段搜索
                $filter->between('created_at', 'Created Time')->datetime();

                //删除默认的搜索字段ID
                $filter->disableIdFilter();

                //添加需要搜索的字段
                $filter->like('name', 'name');


            });
        });
    }

    /**
     * Make a form builder.
     *   点击新增或者修改进入form表单
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->display('name', '会员名称');
            $form->display('email', '邮箱');
           // $form->display('created_at', 'Created At');
           // $form->display('updated_at', 'Updated At');
        });
    }
}
