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
> **NOTE:** These instructions are for developers wanting to integrate Karma with their own modules. 

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

In the snippet below, we are defining an event that says, after a `Question` has been inserted, fire the `onQuestionAfterSave` method in our `Events.php` file.
```
return [
    // ... 
    'events' => [
        [
            'class' => 'humhub\modules\questionanswer\models\Question',
            'event' => 'afterInsert',
            'callback' => ['humhub\modules\questionanswer\Events', 'onQuestionAfterSave'],
        ],
    ]
]
```
This is a pretty generic and gives you the ability to pick and choose which events to respond to by simply listening to an event on the model you're interested in.

When an event is fired by the framework, it attaches an `$event` parameter. You can use this to identify what triggered the event to be fired.

```
/**
 * Adding Karma to a user account
 * 
 * @param  string   $karma_name - Name of Karma record (create via admin panel)
 * @param  integer  $user_id - ID of user to grant Karma on
 * @param  object   $object - Object karma granted on (prevents duplicate karma grants). Optional.
 * @param  bool     $force - Default false. When true allows Karma to be granted to the same user that performed the action.
 * @return bool
 */
```

In your `Events.php` file
```
public static function onQuestionAfterSave($event)
{
    if(isset(Yii::$app->modules['karma'])) {
        Karma::addKarma('asked', $event->sender->user->id, $event->sender, true);
    }
}

```

Don't forget, you have to define a `asked` karma record via the admin panel.


[Example Events.php](https://github.com/ConnectedCommunities/humhub-modules-questionanswer/blob/master/Events.php#L88) 


## TODO
Eventually make it so that people can add karma to any event inside HumHub by defining events to listen for from the admin panel.
