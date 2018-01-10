<?

namespace Usefuls;

class LessonTransformer extends Transformer {

  public function transform($lesson) 
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