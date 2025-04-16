<?php

namespace App\Services;

use App\Models\TutorsMessages;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChatManagementService
{
    private $user;
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * SaveNewMessage - saves new message
     *
     * @param  mixed $newMessage new message's data
     * @return bool saved message to database
     */
    public function SaveNewMessage($newMessage): bool
    {
        # load the tutors messages
        # create the conversation ID in this format: 'userID_StudentSubscribedPackeID_number'
        # add the new message: create a new user entry in this manner 
        # 'userID_StudentSubscribedPackeID_number': {from, to, datetime, message, replyTo(nullable), status(read/unread), attachments} 
        # update the json


        try {
            if (!isset($newMessage['toID']) || !isset($newMessage['fromID']) || !isset($newMessage['message'])) {
                Session::flash('error', 'enter a message before continuing');
                return false;
            }

            $fromID = $this->user->id;
            $toID = $newMessage['toID'];
            $packID = $newMessage['subscribedPackageID'];

            // Fetch or create a TutorsMessages entry for the tutor (sender)
            $tutorMessages = TutorsMessages::firstOrCreate(
                ['userID' => $fromID],
                ['messages' => json_encode([]), 'unreadMessages' => 0]
            );

            $messages = $tutorMessages->messages ?? [];

            // If messages is a JSON string, decode it
            if (is_string($messages)) {
                $messages = json_decode($messages, true);
            }

            // Generate or find conversation ID
            $conversationID = "{$fromID}_{$toID}_{$packID}";

            // Prepare message
            $messageData = [
                'messageID' => $this->generateMessageID(),
                'from' => $fromID,
                'to' => $toID,
                'datetime' => Carbon::now()->toDateTimeString(),
                'message' => $newMessage['message'],
                'replyTo' => $newMessage['replyTo'] ?? null,
                'status' => 'unread',
                'attachments' => $newMessage['attachments'] ?? [],
            ];

            // Append message
            $messages[$conversationID][] = $messageData;

            // Update and save
            $tutorMessages->messages = $messages;
            $tutorMessages->save();

            // Update receiver's unread message counter
            $receiver = \App\Models\User::find($toID);
            if ($receiver) {
                $receiver->unreadMessages = ($receiver->unreadMessages ?? 0) + 1;
                $receiver->save();
            }

            Session::flash('success', 'message sent successfully');

            return true;
        } catch (\Exception $e) {
            Session::flash('error', 'some error occured while saving the message');
            return false;
        }
    }

    /**
     * ReplyToMessage - replies to a given message
     *
     * @param  mixed $reply reply data
     * @return bool saved the reply
     */
    public function ReplyToMessage($reply): bool
    {
        # load the tutors messages
        # get the conversation & add the reply message
        # update the json
        try {
            if (!isset($reply['conversationID'], $reply['from'], $reply['to'], $reply['message'])) {

                Session::flash('error', 'Message is empty');
                return false;
            }

            $conversationID = $reply['conversationID'];
            $fromID = $reply['from'];
            $toID = $reply['to'];

            $tutorMessages = TutorsMessages::where('userID', $fromID)->first();
            if (!$tutorMessages) {
                Session::flash('error', 'user not found');
                return false;
            }

            $messages = is_string($tutorMessages->messages)
                ? json_decode($tutorMessages->messages, true)
                : $tutorMessages->messages;

            if (!isset($messages[$conversationID])) {
                return false;
            }

            // Generate reply message
            $replyMessage = [
                'messageID' => $this->generateMessageID(),
                'from' => $fromID,
                'to' => $toID,
                'datetime' => Carbon::now()->toDateTimeString(),
                'message' => $reply['message'],
                'replyTo' => $reply['replyTo'] ?? null, // must match a messageID in this convo
                'status' => 'unread',
                'attachments' => $reply['attachments'] ?? [],
            ];

            $messages[$conversationID][] = $replyMessage;

            $tutorMessages->messages = $messages;
            $tutorMessages->save();

            // Update receiver's unread message counter
            $receiver = \App\Models\User::find($toID);
            if ($receiver) {
                $receiver->unreadMessages = ($receiver->unreadMessages ?? 0) + 1;
                $receiver->save();
            }

            Session::flash('message', 'Message sent');

            return true;
        } catch (\Exception $e) {
            Session::flash('error', 'some error occured');
            return false;
        }
    }

    public function GenerateMessageID(): string
    {
        return 'msg-' . time() . '-' . rand(1000, 9999);
    }

    /**
     * GetConversation - returns a given conversation in messages
     *
     * @param  mixed $conversationID unique identifier of the conversation
     * @return array
     */
    public function GetConversation(string $conversationID): array
    {
        # load all messages
        # get the conversation & return it

        // Fetch the current user's stored messages
        $tutorMessages = TutorsMessages::where('userID', $this->user->id)->first();

        if (!$tutorMessages) {
            return [];
        }

        $messages = $tutorMessages->messages;

        if (is_string($messages)) {
            $messages = json_decode($messages, true);
        }

        // Return the specific conversation or empty array
        return $messages[$conversationID] ?? [];
    }
}
