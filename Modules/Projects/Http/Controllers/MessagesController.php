<?php

namespace Modules\Projects\Http\Controllers;

use App\Models\Attachment;
use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Projects\Entities\Project;
use Modules\Projects\Entities\Task;

class MessagesController extends Controller
{

    public function messages(Request $request)
    {
        $id = auth()->id();
        $messages = Message::with(['from' => function ($query) {
            $query->select('id', 'name', 'image');
        }, 'seen' => function ($query) {
            $query->select('users.id', 'users.name');
        }, 'attachments'])->project($request->get('projectId'))
            ->where(function ($query) use ($id) {
                $query->where('public', true)->orWhere('to_id', $id);
            })->get();

        return response()->json($messages);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        $userId = auth()->id();
        $message = new Message();
        $message->from_id = $userId;
        $message->to_id = $request->get('userId') ?? null;
        $message->content = $request->get('content') ?? '';
        $message->public = !$request->has('userId');
        $message->messageable_id = $request->get('projectId');
        $message->messageable_type = 'Modules\Projects\Entities\Project';
        $message->save();
        $message->seen()->syncWithoutDetaching([
            $userId => ['seen_at' => now()]
        ]);
        $files = $request->file('files') ?? [];
        foreach ($files as $file) {
            uploadFile($file, 'messages', $message->id, 'files');
        }
        $message->attachments = $message->attachments()->select('attachments.id', 'attachments.path', 'attachments.size','attachments.original_name')->get();
        $message->seen = $message->seen()->select('users.id')->get();
        $message->from = $message->from()->select('users.id', 'users.name', 'users.image')->first();
        return response()->json($message);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function chat(Project $project)
    {
        $allusers = User::projectUsers($project->id)->pluck('id')->toArray();
        if (!in_array(auth()->id(), $allusers)) {
            abort(401);
        }

        return view('projects::projects.chat-page', ['id' => $project->id]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('projects::show');
    }

    public function users(Request $request)
    {
        $id = auth()->id();
        $projectId = $request->get('projectId');
        $project = Project::with(['lastMessage' => function ($query) {
            $query->with(['seen' => function ($q) {
                $q->where('user_id', auth()->id())->select('users.id');
            },'attachments'])->where('public', true)->whereNull('to_id');
        }])->whereId($projectId)->first();

        $allusers = User::notMe()->projectUsers($projectId)->get(['id', 'name', 'image']);

        $allusers->map(function ($user) use ($projectId, $id) {
            $userId = $user->id;
            $user->last_message = Message::with(['seen' => function ($query) {
                $query->where('user_id', auth()->id());
            }])
                ->where(function ($query) use ($id, $userId) {
                    $query->where('from_id', $id)
                        ->where('to_id', $userId);
                })
                ->orWhere(function ($query) use ($id, $userId) {
                    $query->where('from_id', $userId)
                        ->where('to_id', $id);
                })->project($projectId)
                ->orderBy('created_at', 'desc')
                ->first();
            $userId = null;
            return $user;
        });

        $users = $allusers->sortByDesc(function ($user) {
            return $user->last_message;
        })->values()->all();

        return response()->json(['users' => $users, 'project' => $project]);
    }


    public function user(Request $request)
    {
        $projectId = $request->get('projectId');
        $userId = $request->get('userId');
        $id = auth()->id();
        $user = User::find($userId);

        $messages = Message::with(['from', 'to','attachments', 'seen' => function ($q) {
            $q->where('user_id', auth()->id());
        }])->where(function ($query) use ($id, $userId) {
            $query->where('from_id', $id)
                ->where('to_id', $userId);
        })->orWhere(function ($query) use ($id, $userId) {
            $query->where('from_id', $userId)
                ->where('to_id', $id);
        })->where('public', false)->project($projectId)->orderBy('created_at', 'asc')->get();

        $messageIds = $messages->pluck('id')->toArray();
        $syncData = [];

        foreach ($messageIds as $messageId) {
            $syncData[$messageId] = ['seen_at' => now()];
        }

        auth()->user()->seens()->syncWithoutDetaching($syncData);

        return response()->json(['messages' => $messages, 'user' => $user]);
    }

    public function project(Request $request)
    {
        $projectId = $request->get('projectId');
        $project = Project::findOrFail($projectId);
        $id = auth()->id();
        $messages = Message::project($projectId)->where('public', true)->with(['from' => function ($query) {
            $query->select('id', 'name', 'image');
        },'attachments'])->get();

        return response()->json(['messages' => $messages, 'userId' => $id, 'project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('projects::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
