<?php

namespace Modules\User\src\Http\Controllers;

use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Models\User;
use App\Http\Controllers\Controller;
use Modules\User\src\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $users = $this->userRepo->getUsers(5);
        $pageTitle = 'Danh Sách Người Dùng';
        $check = $this->userRepo->checkPassword('11111', 1);
        return view('user::lists', compact('pageTitle'));
    }

    public function detail($id)
    {
        return view('user::detail', compact('id'));
    }

    public function create()
    {
        $pageTitle = "Thêm Người Dùng";
        return view('user::add', compact('pageTitle'));
    }
    public function store(UserRequest $request){
        $this->userRepo->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'group_id' => $request->group_id,
        ]);
        return redirect()->route('admin.users.index')
            ->with('msg',
                __('user::messages.success',
                    [
                        'action' => 'Thêm',
                        'attribute' => 'người dùng'
                    ]
                )
            )
            ->with('type', 'success');
    }
}
