<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lesson;

use App\Http\Controllers\Controller;

class LessonsController extends Controller
{
  public function index() 
  {
    $lessons = Lesson::all();
    return response()->json(
      [
        'data' => $this->transformCollection($lessons)
      ]
    );
  }

  public function show($id) 
  {
    $lesson = Lesson::find($id);
    if (!$lesson) {
      /**
       * @todo respondeNoteFound located in BaseController. Always abstract resuables into base classes for better maintainability
       */
      return $this->respondNotFound('Resource Not Found');
    } else {
      return $this->respond($this->transform($lesson));
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
