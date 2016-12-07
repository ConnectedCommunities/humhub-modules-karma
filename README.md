# Karma
This module adds a Karma system to your HumHub installation.

## Installation 
Karma hasn't yet been added to the HumHub market place, so for the time being, you will need to install it manually. Don't worry, it's not as hard as it sounds!

- Clone the karma module into your modules directory 
```
cd protected/modules
git clone https://github.com/ConnectedCommunities/humhub-modules-karma.git karma
```

- Go to Admin > Modules. You should now see the Karma module in your list of installed modules

-  Click "Enable". This will install the Karma module for you


## Usage
This is the first implementation of the Karma module. 
Currently, the module is best used as an addition to other modules that wish to implement a karma system. 
That's because you can create Karma events via the admin panel but to implement them you have to code it. 
It is on the roadmap to make this a full featured karma system out of the box.

You can grant Karma like so: 
```
use humhub\modules\karma\models\Karma;
// ...
Karma::addKarma('karma_title', $user->id);
```

For the Karma to be attached to the users account, you **must** define the karma record in the Karma admin panel 

### Implementing Karma with Events.php
It's recommended that you take advantage of the `Events` HumHub exposes to define when Karma should be added. This will help keep your code clean from random `addKarma` calls.

Use your `config.php` to define when an event should be fired and how it should be handled. 

In the snippet below, we are defining an event that says, after an `ActiveRecord` has been inserted, fire the `onActiveRecordAfterSave` method in our `Events.php` file.
```
return [
    // ... 
    'events' => [
        [
            'class' => \humhub\components\ActiveRecord::className(),
            'event' => \humhub\components\ActiveRecord::EVENT_AFTER_INSERT,
            'callback' => ['humhub\modules\questionanswer\Events', 'onActiveRecordAfterSave'],
        ],
    ]
]
```
This is a pretty generic and gives you the ability to pick and choose which events to respond to.

When `onActiveRecordAfterSave` is fired by the framework, it attaches an `$event` parameter. You can use this to identify what triggered the event to be fired.

In your `Events.php` file
```
public static function onActiveRecordAfterSave($event)
{
    switch(get_class($event->sender)) {
        case Question::className():
            self::onQuestionAfterSave($event);
            Karma::addKarma('asked_question', $event->sender->user->id);
            break;
    }
}
```

Don't forget, you have to define a `asked_question` karma record via the admin panel.
