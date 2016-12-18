<?php



namespace Xelcronia\Main;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\player\PlayerChatEvent;


class Main extends PluginBase implements Listener
{

    public $c;


    public function onEnable()
    {
        @mkdir($this->getDataFolder());
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveResource("config.yml");
        $this->c = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->getLogger()->info(TF::GREEN . "VoteM Enabled!");
    }

    public function onDisable()
    {
        $this->getLogger()->info(TF::RED . "VoteM Disabled! Did the server stop?");
    }


    /**
     * @param PlayerChatEvent $event
     */
    public function onChat(PlayerChatEvent $event)
    {
        $player = $event->getPlayer();
        $message = $event->getMessage();
    if ($this->getConfig()->get(strtolower("vote-hw")) == "true") {
        if (strpos(strtolower($message), "vote") !== FALSE) {
            if (strpos(strtolower($message), "how") !== FALSE) {
                $player->sendMessage($this->getConfig()->get("message-how"));
                return;
            } elseif (strpos(strtolower($message), "where") !== FALSE) {
                $player->sendMessage($this->getConfig()->get("message-where"));
                return;
            }
        }
    }
        if ($this->getConfig()->get(strtolower("vote")) == "true") {
            if (strpos(strtolower($message), "vote") !== FALSE) {
                $player->sendMessage($this->getConfig()->get("message-vote"));
                return;

            }


        }

    }
}