<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lesson;

class LessonsController extends Controller
{
  public function index() 
  {
    $lessons = Lesson::all();
    return response()->json(
      [
        'data' => $this->transformCollection($lessons)
      ], 
      200
    );
  }

  public function show($id) 
  {
    $lesson = Lesson::find($id);
    if (!$lesson) {
      return response()->json(
        [
          'error' => [
            'message' => 'resource not found.'
          ]
        ]
      , 404);
    } else {
      return response()->json(
        [
          'data' => $this->transform($lesson)
        ]
      , 200);
    }
  }

  private function transformCollection($lessons) 
  {
    return array_map([$this, 'transform'], $lessons->toArray());
  }

  private function transform($lesson) 
  {
    // NOTE: how this works for both arrays (the lessons collection passed through array_map above AND a signle lesson object due to array style notation)
    // NOTE: it's good to set different keys inside of your API objects because as to eliminate risk of the database structure changing in the future and breaking functionality of people using your API.
    return [
      'title'  => $lesson['title'],
      'body'   => $lesson['body'],
      'active' => (boolean)$lesson['some_bool'] 
    ];
  }
}
