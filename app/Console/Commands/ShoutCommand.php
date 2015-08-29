<?php
namespace App\Console\Commands;

use App\Shout;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ShoutCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'shout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shouts random stuff into the conversation.';

    protected $shouts = [

        // Filler
        'Introducing... *drum roll*',
        'The slowest shoutbox ever built using modern components!',
        'It\'s so slow, in fact, that these messages are being posted via cron because the shout messages need a queue worker!',
        'Yep, shout messages need to go via the queue. A very silly design, if I do say so myself.',
        'So... what shall we do while we wait?',

        // Tolkien
        'A song! A song! A song!',
        'Come on now, master, sing us something that we haven\'t heard before!',

        'There is an inn, a merry old inn',
        'beneath an old grey hill,',
        'And there they brew a beer so brown',
        'That the Man in the Moon himself came down',
        'one night to drink his fill.',
        'The ostler has a tipsy cat',
        'that plays a five-stringed fiddle;',
        'And up and down he saws his bow',
        'Now squeaking high, now purring low,',
        'now sawing in the middle.',
        'The landlord keeps a little dog',
        'that is mighty fond of jokes;',
        'When there\'s good cheer among the guests,',
        'He cocks an ear at all the jests',
        'and laughs until he chokes.',
        'They also keep a hornéd cow',
        'as proud as any queen;',
        'But music turns her head like ale,',
        'And makes her wave her tufted tail',
        'and dance upon the green.',
        'And O! the rows of silver dishes',
        'and the store of silver spoons!',
        'For Sunday there\'s a special pair,',
        'And these they polish up with care',
        'on Saturday afternoons.',
        'The Man in the Moon was drinking deep,',
        'and the cat began to wail;',
        'A dish and a spoon on the table danced,',
        'The cow in the garden madly pranced',
        'and the little dog chased his tail.',
        'The Man in the Moon took another mug,',
        'and then rolled beneath his chair;',
        'And there he dozed and dreamed of ale,',
        'Till in the sky the stars were pale,',
        'and dawn was in the air.',
        'Then the ostler said to his tipsy cat:',
        'The white horses of the Moon,',
        'They neigh and champ their silver bits;',
        'But their master\'s been and drowned his wits,',
        'and the Sun\'ll be rising soon!',
        'So the cat on the fiddle played hey-diddle-diddle,',
        'a jig that would wake the dead:',
        'He squeaked and sawed and quickened the tune,',
        'While the landlord shook the Man in the Moon:',
        'It\'s after three!\' he said.',
        'They rolled the Man slowly up the hill',
        'and bundled him into the Moon,',
        'While his horses galloped up in rear,',
        'And the cow came capering like a deer,',
        'and a dish ran up with the spoon.',
        'Now quicker the fiddle went deedle-dum-diddle;',
        'the dog began to roar,',
        'The cow and the horses stood on their heads;',
        'The guests all bounded from their beds',
        'and danced upon the floor.',
        'With a ping and a pang the fiddle-strings broke!',
        'the cow jumped over the Moon,',
        'And the little dog laughed to see such fun,',
        'And the Saturday dish went off at a run',
        'with the silver Sunday spoon.',
        'The round Moon rolled behind the hill,',
        'as the Sun raised up her head.',
        'She hardly believed her fiery eyes;',
        'For though it was day, to her surprise',
        'they all went back to bed!',
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $position = Cache::get(self::class, 0);

        if (!isset($this->shouts[$position])) {
            return;
        }

        Shout::create([
            'message' => $this->shouts[$position],
        ]);

        Cache::forever(self::class, ++$position);
    }
}
