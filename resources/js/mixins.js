export default{  

    computed:{        
        toUpper(){
            return this.uppercase.reduce((acc, item) => {          
                acc[item.id] = item.tag.charAt(0).toUpperCase() + item.tag.slice(1);
                return acc;
            }, {});
          }
    }
    
}