<?php

  namespace GeoProtection;

  use pocketmine\plugin\PluginBase;
  use pocketmine\utils\TextFormat as TF;
  use pocketmine\event\Listener;
  use pocketmine\event\Cancellable;
  use pocketmine\event\player\PlayerPreLoginEvent;

  class Main extends PluginBase implements Listener {

    public function onJoin() {

      $fileDir = "GeoProtection/data.txt";

      if(!(file_exists($fileDir))) {

        @mkdir("GeoProtection/");
        chmod("GeoProtection/", 0777);
        chdir("GeoProtection/");
        touch("data.txt");

      }

    }

    public function onPlayerPreLogin(PlayerPreLoginEvent $event) {

      $file = file_get_contents("data.txt");
      $player = $event->getPlayer();
      $name = $player->getName();
      $ip = $player->getAddress();
      $geo = json_decode(file_get_contents("ipinfo.io/{$ip}"));
      $city = $geo->city;
