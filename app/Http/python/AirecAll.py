import joblib
import numpy as np
import sys

model_knn = joblib.load('C:\\Work\\xampp\\htdocs\\Review\\app\\Http\\python\\recommend_knn.pkl')

import mysql.connector as sql
import pandas as pd



userid = int(sys.argv[1])

conn = sql.connect(host='localhost',database ='datareview',
                  user='root', password='')

like_query = 'select * from likes'
mv_query = 'select * from movies'

x = pd.read_sql(like_query,conn)
movies = pd.read_sql(mv_query,conn)

x.to_csv('user_like.csv')

movies.drop(columns=['image','type_id','detail','link_video','created_at','updated_at','deleted_at','rating'],inplace=True)
x.drop(columns=['id','created_at','updated_at'],inplace=True)

movie_features = x.pivot(index='user_id',columns='movie_id',values='rating').fillna(0)

test_value = movie_features.loc[[userid]]
gettest_value = test_value.values.tolist()
gettest_value = np.array(gettest_value)

predict_rs = model_knn.kneighbors(test_value)

#get user movie id
user_movie_id = test_value.loc[:, (test_value == 1.0).any()]
user_movie_id = user_movie_id.columns.to_list()
user_movie_id


def mv_predict(predict_rs):
    uniq = []
    for i in range(5):
        feature_index = predict_rs[1][0][i]      
        mv_id = movie_features.loc[[movie_features.index[feature_index]]]
        mv_id = mv_id.loc[:, (mv_id == 1.0).any()]
        mv_id = mv_id.columns.to_list()

        #predict movie
        pdt = mv_id
        #user movie
        usr = user_movie_id
        for x in pdt:
            if x not in usr:
                if x not in uniq:
                    uniq.append(x)
    return uniq
        
mv_predict(predict_rs)


mv_pd_id = mv_predict(predict_rs)
import random
def rd_predict(mv_pd_id):
    movies = []
    rd_test = random.sample(range(0, len(mv_pd_id)), 6)
    
    for i in range(6):
        movies.append(mv_pd_id[rd_test[i]])
    return movies

recommend = rd_predict(mv_pd_id)
rec1 = recommend[0]
rec2 = recommend[1]
rec3 = recommend[2]
rec4 = recommend[3]
rec5 = recommend[4]
rec6 = recommend[5]

recall = str(rec1) + ","+str(rec2) + ","+str(rec3) + ","+str(rec4) + ","+str(rec5) + ","+str(rec6)

print(recall)